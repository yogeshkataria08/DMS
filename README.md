OVERVIEW
    
    1. Data management system is a generic project which will be used by users as per their roles & duties.
    2. We want a system that can handle the data of our organization & the operations in a generic manner. 
    3. This system will act like an admin panel where there will be users with specified roles.
    4. Each role will play their respective responsibilities.
    1. Modules
        1. Authentication
            1. Login page
                1. Email
                2. Password
                    1. Note: First login will be done via superadmin. Please read below to understand the roles of the system.
            2. Module Rules:
                1. 2 factor authentication:
                    1. Whenever a user hits the login button, a 6 digits OTP must be sent on his email & a he should be redirected to a page where he can enter the OTP
                    2. The user needs to enter the OTP. If successful, then the user should be redirected to the dashboard. If authentication fails, then the user must be redirected back to the login page.
            3. Logout functionality
        2. Dashboard
            1. Module Rules: 
                1. The Dashboard will show users only the summary of system with following sections:
                    1. Total number of users in the system ( Count )
                    2. Total number of categories in the system ( Count )
                    3. Total number of products in the system ( Count )
        3. User Management
            1. Forms & Fields:
                1. Create User
                    1. First Name (Text Field)
                    2. Last Name (Text Field)
                    3. Email (Email only)
                    4. Password / Confirm Password ( Password )
                    5. User Role ( Dropdown ) ( Note: 1. There will be 3 roles as mentioned below. 2. Please maintain a role master as more roles can be added in future for generic usage of the project )
                        1. Superadmin ( Should be a secret role only for developers & they can access every module in the system. Superadmin should be added via Seeder & no option for adding a super admin should be available in the portal )
                        2. User Admin
                        3. Sales Team
                    6. Timestamps ( Backend Activity )
                2. List Users ( Datatable with pagination )
                3. Update Users
                4. Delete Users ( Note: Users should be soft deleted )
                5. Download Users ( A button should be available to download all users information from the listing page. On clicking, a CSV should be downloaded )
            2. Module Visibility:
                1. User admins can create, read, update & delete users.
                2. The Sales Team can only view users listed in the table & download users.
            3. Module Rules:
                1. When a user is created he/she should receive an email from the system with his login credentials & welcome text.
                2. When user details are updated, users should be notified via email with updated details.
                3. Latest Users should be shown on top.
                4. Confirmation should be asked before deleting users.
                5. Validations on form fields
        4. Category Management
            1. Forms & Fields:
                1. Create Category
                    1. Category Name ( Text Field )
                    2. Category Description ( Textarea )
                    3. Timestamps ( Backend Activity )
                2. List Categories ( Datatable with pagination )
                3. Update Categories
                4. Delete Categories ( Note: Categories should be soft deleted )
            2. Module Visibility:
                1. Only the Sales Team can access & view this module.
                2. Develop a middleware to avoid user admins from accessing this module.
            3. Module Rules:
                1. Whenever a category is about to get deleted, a warning popup should be asked to the user that if he deletes a category, all the products related to that category will be deleted. If user selects Yes, then soft delete all the products related to that category as well
                2. Latest Categories should be shown on top
                3. Validations on form fields
        5. Products Management
            1. Forms & Fields:
                1. Create Products
                    1. Product Name ( Text Field )
                    2. Product Description ( Textarea )
                    3. Product Price ( Number )
                    4. Product Image ( Note: Image should be <= 2 Mb & should be accepted in only these formats -> jpeg, jpg, png )
                    5. Product Category ( Dropdown )
                    6. Timestamps ( Backend Activity )
                2. List Products ( Datatable with pagination )
                3. Update Products
                4. Delete Products ( Note: Products should be soft deleted )
            2. Module Visibility:
                1. Only the Sales Team can access & view this module.
                2. Develop a middleware to avoid user admins from accessing this module.
            3. Module Rules:
                1. Confirmation should be asked before deleting products.
                2. Latest products should be shown on top.
                3. In the products listing page, product images should be displayed in the datatable.
                4. In the listing page, if a user clicks on a product category name, a bootstrap modal should open with category details.
                5. Validations on form fields
                6. Please use One-To-Many Relationship between Categories & Products
    2. Technological Requirements
        1. Laravel ( Preferably, the latest version )
            1. Expected mechanisms:
                1. Middleware
                2. Migrations
                3. Seeders
                4. Server-side Datatables
                5. ORM & Relationships
           
        2. MySQL
        3. HTML / Bootstrap / CSS / Javascript / Jquery / Ajax
        4. Github
        5. Coding Standards:
            1. Proper indentation
            2. Comments over functions with necessary information such as parameters, return values etc
            3. Proper data types usage.



Please follow Below Guidelines for setup :

Create .env && add db details and mail configuration

composer install 

npm install && npm run development 

php artisan migrate --seed php artisan serve

php artisan queue:listen // email queue

Admin Username: admin@adminer.com Admin pass : admin123
