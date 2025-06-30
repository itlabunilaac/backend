<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JurnalController extends Controller
{
    /**
     * Display a listing of journals with search, filter, and pagination
     */
    public function index(Request $request)
    {
        $query = Jurnal::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Filter by subject
        if ($request->has('subject') && $request->subject) {
            $query->subject($request->subject);
        }

        // Filter by akreditasi
        if ($request->has('akreditasi') && $request->akreditasi) {
            $query->akreditasi($request->akreditasi);
        }

        // Sort by views or other fields
        if ($request->has('sort_by')) {
            $sortBy = $request->sort_by;
            $sortOrder = $request->get('sort_order', 'desc'); // default desc
            
            if (in_array($sortBy, ['views', 'created_at', 'judul'])) {
                $query->orderBy($sortBy, $sortOrder);
            }
        } else {
            // Default sort by latest
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $journals = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Journals retrieved successfully',
            'data' => $journals
        ], 200);
    }

    /**
     * Store a newly created journal
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'akreditasi' => 'required|string',
            'link_akreditasi' => 'nullable|url',
            'subject' => 'required|string',
            'penerbit' => 'required|string',
            'link_penerbit' => 'nullable|url',
            'judul' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('foto');

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('journals', $fotoName, 'public');
            $data['foto'] = $fotoPath;
        }

        $jurnal = Jurnal::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Journal created successfully',
            'data' => $jurnal
        ], 201);
    }

    /**
     * Display the specified journal and increment views
     */
    public function show($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Journal not found'
            ], 404);
        }

        // Increment views
        $jurnal->incrementViews();

        return response()->json([
            'success' => true,
            'message' => 'Journal retrieved successfully',
            'data' => $jurnal
        ], 200);
    }

    /**
     * Update the specified journal
     */
    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Journal not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'sometimes|required|string',
            'akreditasi' => 'sometimes|required|string',
            'link_akreditasi' => 'nullable|url',
            'subject' => 'sometimes|required|string',
            'penerbit' => 'sometimes|required|string',
            'link_penerbit' => 'nullable|url',
            'judul' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('foto');

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($jurnal->foto && Storage::disk('public')->exists($jurnal->foto)) {
                Storage::disk('public')->delete($jurnal->foto);
            }

            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('journals', $fotoName, 'public');
            $data['foto'] = $fotoPath;
        }

        $jurnal->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Journal updated successfully',
            'data' => $jurnal
        ], 200);
    }

    /**
     * Remove the specified journal
     */
    public function destroy($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Journal not found'
            ], 404);
        }

        // Delete associated file
        if ($jurnal->foto && Storage::disk('public')->exists($jurnal->foto)) {
            Storage::disk('public')->delete($jurnal->foto);
        }

        $jurnal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Journal deleted successfully'
        ], 200);
    }

    /**
     * Get unique subjects for filtering
     */
    public function getSubjects()
    {
        $subjects = Jurnal::distinct()->pluck('subject')->filter()->values();

        return response()->json([
            'success' => true,
            'data' => $subjects
        ], 200);
    }

    /**
     * Get unique akreditasi for filtering
     */
    public function getAkreditasi()
    {
        $akreditasi = Jurnal::distinct()->pluck('akreditasi')->filter()->values();

        return response()->json([
            'success' => true,
            'data' => $akreditasi
        ], 200);
    }
}
