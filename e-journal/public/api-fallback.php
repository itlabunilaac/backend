<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Get the request path
$path = $_GET['endpoint'] ?? $_SERVER['REQUEST_URI'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// Clean the path
if (strpos($path, '?') !== false) {
    $path = substr($path, 0, strpos($path, '?'));
}

// Sample data
$sampleJurnals = [
    [
        'id' => 1,
        'judul' => 'Machine Learning for Healthcare Diagnosis',
        'penulis' => 'Dr. Ahmad Santoso',
        'subjek' => 'Teknologi Informasi',
        'akreditasi' => 'Sinta 1',
        'views' => 2500,
        'url' => 'https://example.com/journal1',
        'created_at' => '2025-01-01 10:00:00',
        'updated_at' => '2025-01-01 10:00:00'
    ],
    [
        'id' => 2,
        'judul' => 'Sustainable Energy Solutions for Smart Cities',
        'penulis' => 'Prof. Siti Rahayu',
        'subjek' => 'Lingkungan',
        'akreditasi' => 'Scopus',
        'views' => 1800,
        'url' => 'https://example.com/journal2',
        'created_at' => '2025-01-01 11:00:00',
        'updated_at' => '2025-01-01 11:00:00'
    ],
    [
        'id' => 3,
        'judul' => 'Economic Impact of Digital Transformation',
        'penulis' => 'Dr. Budi Hartono',
        'subjek' => 'Ekonomi',
        'akreditasi' => 'Sinta 2',
        'views' => 1200,
        'url' => 'https://example.com/journal3',
        'created_at' => '2025-01-01 12:00:00',
        'updated_at' => '2025-01-01 12:00:00'
    ]
];

// Get token from Authorization header
$token = null;
$headers = getallheaders();
if (isset($headers['Authorization'])) {
    $authHeader = $headers['Authorization'];
    if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
        $token = $matches[1];
    }
}

function requireAuth() {
    global $token;
    if (!$token || strlen($token) < 40) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Unauthorized. Token required.'
        ]);
        exit();
    }
}

function sendResponse($data, $success = true, $message = 'Success', $status = 200) {
    http_response_code($status);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Handle different endpoints
switch ($method) {
    case 'GET':
        if (strpos($path, '/admin/profile') !== false) {
            requireAuth();
            sendResponse([
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'created_at' => '2025-01-01 10:00:00'
            ], true, 'Profile retrieved successfully');
            
        } elseif (strpos($path, '/test') !== false) {
            sendResponse([
                'version' => '1.0.0-fallback',
                'timestamp' => date('Y-m-d H:i:s'),
                'environment' => 'fallback'
            ], true, 'API is working (fallback mode)');
            
        } elseif (strpos($path, '/jurnal/subjects') !== false) {
            sendResponse([
                'Teknologi Informasi',
                'Lingkungan',
                'Ekonomi',
                'Kesehatan',
                'Pendidikan'
            ], true, 'Subjects retrieved successfully');
            
        } elseif (strpos($path, '/jurnal/akreditasi') !== false) {
            sendResponse([
                'Sinta 1',
                'Sinta 2',
                'Sinta 3',
                'Scopus',
                'Web of Science'
            ], true, 'Akreditasi retrieved successfully');
            
        } elseif (strpos($path, '/jurnal') !== false && preg_match('/\/jurnal\/(\d+)/', $path, $matches)) {
            $id = (int)$matches[1];
            global $sampleJurnals;
            $jurnal = array_filter($sampleJurnals, function($j) use ($id) { return $j['id'] == $id; });
            if ($jurnal) {
                sendResponse(array_values($jurnal)[0], true, 'Journal retrieved successfully');
            } else {
                sendResponse(null, false, 'Journal not found', 404);
            }
            
        } elseif (strpos($path, '/jurnal') !== false) {
            // List journals with pagination
            global $sampleJurnals;
            sendResponse([
                'data' => $sampleJurnals,
                'total' => count($sampleJurnals),
                'per_page' => 10,
                'current_page' => 1,
                'last_page' => 1
            ], true, 'Journals retrieved successfully');
            
        } elseif (strpos($path, '/sample/stats') !== false) {
            sendResponse([
                'total_journals' => count($sampleJurnals),
                'total_views' => array_sum(array_column($sampleJurnals, 'views')),
                'subjects' => ['Teknologi Informasi', 'Lingkungan', 'Ekonomi'],
                'akreditasi' => ['Sinta 1', 'Sinta 2', 'Scopus']
            ], true, 'Statistics retrieved successfully');
            
        } elseif (strpos($path, '/status') !== false) {
            sendResponse([
                'version' => '1.0.0-fallback',
                'timestamp' => date('Y-m-d H:i:s'),
                'endpoints' => [
                    'GET /jurnal - List journals',
                    'GET /jurnal/{id} - Get journal detail',
                    'POST /admin/login - Admin login',
                    'GET /admin/profile - Admin profile (requires auth)'
                ]
            ], true, 'API status');
        }
        break;
        
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (strpos($path, '/admin/logout') !== false) {
            requireAuth();
            sendResponse(null, true, 'Logout successful');
            
        } elseif (strpos($path, '/admin/change-password') !== false) {
            requireAuth();
            if (!$input['current_password'] || !$input['new_password']) {
                sendResponse(null, false, 'Current and new password required', 422);
            }
            sendResponse(null, true, 'Password changed successfully');
            
        } elseif (strpos($path, '/admin/jurnal') !== false) {
            requireAuth();
            if (!$input['judul'] || !$input['penulis']) {
                sendResponse(null, false, 'Title and author required', 422);
            }
            $newJurnal = [
                'id' => 999,
                'judul' => $input['judul'],
                'penulis' => $input['penulis'],
                'subjek' => $input['subjek'] ?? 'Umum',
                'akreditasi' => $input['akreditasi'] ?? 'Tidak Terakreditasi',
                'views' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            sendResponse($newJurnal, true, 'Journal created successfully', 201);
            
        } elseif (strpos($path, '/sample/generate') !== false) {
            sendResponse([
                'generated' => count($sampleJurnals),
                'message' => 'Sample data generated successfully'
            ], true, 'Sample data generated');
        }
        break;
        
    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (strpos($path, '/admin/jurnal') !== false && preg_match('/\/admin\/jurnal\/(\d+)/', $path, $matches)) {
            requireAuth();
            $id = (int)$matches[1];
            sendResponse([
                'id' => $id,
                'judul' => $input['judul'] ?? 'Updated Title',
                'penulis' => $input['penulis'] ?? 'Updated Author',
                'updated_at' => date('Y-m-d H:i:s')
            ], true, 'Journal updated successfully');
        }
        break;
        
    case 'DELETE':
        if (strpos($path, '/admin/jurnal') !== false && preg_match('/\/admin\/jurnal\/(\d+)/', $path, $matches)) {
            requireAuth();
            $id = (int)$matches[1];
            sendResponse(null, true, 'Journal deleted successfully');
        }
        break;
}

// Default response
sendResponse(null, false, 'Endpoint not found', 404);
?>
