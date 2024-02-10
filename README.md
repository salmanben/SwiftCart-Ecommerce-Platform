# SwiftCart: Multivendor Ecommerce Platform

Welcome to SwiftCart, the cutting-edge multivendor ecommerce platform meticulously crafted using Laravel, Bootstrap, and JavaScript to offer an unparalleled shopping experience!

## Features

- Coupon System: Delight your customers with enticing discounts through personalized coupon codes tailored to their preferences.
- Shipping: SwiftCart simplifies shipping management. Buyers can select their preferred shipping method during checkout, enhancing the overall shopping experience.
- Review System: Enhance customer engagement and trust by allowing buyers to review products they have purchased after delivery. Enable customers to share their experiences and provide feedback, fostering a transparent and credible shopping environment.
- Withdrawal Management: SwiftCart facilitates a frictionless withdrawal process for sellers, allowing them to effortlessly transfer their earnings to their designated accounts. Sellers can conveniently monitor their earnings and initiate withdrawal requests directly from their accounts.
- Subscription Services: Provide flexible subscription options for users to stay updated with offers. Admins can send emails to subscribers, notifying them about promotions and new products.
- OAuth Login: Simplify user authentication with seamless login and signup options using personal credentials or leveraging existing GitHub or Google accounts.
- Robust Product Search and Filtering: Empower users with efficient product search functionalities and intuitive filtering options, enabling them to find desired items effortlessly.
- Secure Payment Gateways: Ensure smooth transactions through trusted payment gateways, including PayPal and Stripe, offering customers peace of mind during checkout.
- Admin Control: Enjoy dynamic, 100% control over all aspects of the platform with comprehensive admin management functionalities.

## Getting Started

To use SwiftCart, follow these steps:
1. Run command `composer install`.
2. Create database `swiftcart`.
3. Run migrations: `php artisan migrate`.
4. Run seeder: `php artisan db:seed --class=UserSeeder` to create the main admin account.
   - Note: The first user in the database (with id = 1) must have the role admin. This is the main admin who can delete other admins and change their account status. Other admins don't have the authority to delete or change the status of another admin. Please refrain from changing its id or role from the database after running the seeder.
5. Run seeder `php artisan db:seed --class=VendorSeeder` to create the admin vendor profile.
6. Access app/Providers/AppServiceProvider.php and uncomment the code inside the boot function.
7. Run the commands `mv upload storage/app/public` and then  `php artisan storage:link`.
8. Run command `php artisan serve`.
9. Connect using the admin account:
   - Email: benomarsalman11212@gmail.com
   - Password: SALMAN123
   - URL: [http://localhost:8000/admin/login](http://localhost:8000/admin/login)
10. Fill in email settings, general settings,  PayPal, and Stripe configurations.
11. There is default data present, so you can update it, such as website icon, name, contact info, etc.

## Video Recorder

Here is a brief demonstration of some features and usage of SwiftCart Ecommerce Platform: [Watch Video](https://drive.google.com/file/d/1rUTWT0IwdwSlalD4kuoaLHOFmQ4n_ugz/view?usp=sharing)

## Contributing

We welcome contributions from the community to improve SwiftCart Ecommerce Platform. If you have ideas for new features, bug fixes, or enhancements, please feel free to submit a pull request on GitHub.

## Support

For any questions, feedback, or support requests, please contact [salmanbenomar250@gmail.com](mailto:salmanbenomar250@gmail.com).
