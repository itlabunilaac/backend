-- SQL untuk membuat tabel admin_tokens
CREATE TABLE IF NOT EXISTS admin_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id BIGINT UNSIGNED NOT NULL,
    token VARCHAR(80) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    last_used_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
    INDEX idx_admin_id (admin_id),
    INDEX idx_token (token),
    INDEX idx_expires_at (expires_at)
);
