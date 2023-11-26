cài đặt laragon và copy src vào để chạy dưới local và mySQL

1. **Clone dự án từ GitHub**: Sử dụng lệnh `git clone` cùng với URL của kho lưu trữ GitHub¹. Ví dụ: `git clone https://github.com/username/repository-name.git`¹.
2. **Di chuyển vào thư mục dự án**: Sử dụng lệnh `cd` để di chuyển vào thư mục chứa dự án¹. Ví dụ: `cd repository-name`¹.
3. **Cài đặt các gói phụ thuộc của Composer**: Sử dụng lệnh `composer install` để cài đặt các gói phụ thuộc được định nghĩa trong tệp `composer.json`¹.
4. **Tạo tệp .env**: Sao chép tệp `.env.example` và đổi tên thành `.env`¹. Bạn có thể sử dụng lệnh `cp .env.example .env`¹.
5. **Tạo khóa ứng dụng**: Sử dụng lệnh `php artisan key:generate` để tạo một khóa mới cho ứng dụng của bạn¹.
6. **Chạy các migration**: Sử dụng lệnh `php artisan migrate` để tạo cấu trúc cơ sở dữ liệu¹.
7. **Chạy các seeder (nếu có)**: Nếu dự án của bạn có các seeder để khởi tạo dữ liệu, bạn có thể chạy chúng bằng lệnh `php artisan db:seed`¹.
8. **Khởi động máy chủ phát triển**: Sử dụng lệnh `php artisan serve` để khởi động máy chủ phát triển¹. Sau đó, bạn có thể truy cập ứng dụng của mình tại `http://localhost:8000`¹.



