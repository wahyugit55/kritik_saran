Dokumentasi Endpoint Route API:
Autentikasi:

POST /auth/login: Melakukan login dan mengembalikan token.
Dashboard:

GET /super-admin/dashboard: Menampilkan dashboard super admin.
GET /student/dashboard: Menampilkan dashboard siswa.
GET /school-staff/dashboard: Menampilkan dashboard staff sekolah.
Kritik dan Saran:

POST /kritik-saran: Membuat kritik dan saran baru.
GET /kritik-saran/user: Menampilkan kritik dan saran dari pengguna terautentikasi.
PUT /kritik-saran/{id}: Memperbarui kritik dan saran.
DELETE /kritik-saran/{id}: Menghapus kritik dan saran.
GET /kritik-saran/{id}: Menampilkan detail kritik dan saran.
Feedback:

POST /feedback: Membuat feedback baru.
Tanggapan:

POST /tanggapan: Membuat tanggapan baru.
Kategori Kritik:

POST /kategori-kritik: Membuat kategori kritik baru.
GET /kategori-kritik/{id}: Menampilkan detail kategori kritik.
PUT /kategori-kritik/{id}: Memperbarui kategori kritik.
DELETE /kategori-kritik/{id}: Menghapus kategori kritik.
Pengelolaan Pengguna (Users):

GET /users/{id}: Menampilkan detail pengguna.
POST /users: Membuat pengguna baru.
PUT /users/{id}: Memperbarui pengguna.
DELETE /users/{id}: Menghapus pengguna.
