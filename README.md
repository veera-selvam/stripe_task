Interview Task :

1. Create a migration class for the products table with fields Name, Price, and Description.
2. Create a DB seeder class for product sample data (via DB seed).
3. List products in Grid view & for each product display name, price & 'Buy Now' button.
4. On clicking the buy now button redirect to a new page. Display the product detail with a Stripe credit card form on this new page.
5. When the Stripe credit card form is filled, make a charge for the selected product via Stripe using Laravel Cashier.

Instructions:

    Follow the given steps:
    
    Update Vendor Folder:
    composer install
    
    Run Migration:
    php artisan migrate
    
    Run Seeder:
    php artisan db:seed


![Home Page](https://github.com/veera-selvam/stripe_task/assets/57904513/dfa73583-e511-4dbb-8b7c-3c42919f6129)

Producti Details with Payment Screen:

![Product-Details-with-Payment](https://github.com/veera-selvam/stripe_task/assets/57904513/d32f7d57-f9cf-44b9-8201-4daa7d67fbbc)

Testing Card Details:

![TESTING-CARD](https://github.com/veera-selvam/stripe_task/assets/57904513/750632e8-4eec-430e-ac0c-a47dde3f5335)


Already Paid Details:
![StripePayment](https://github.com/veera-selvam/stripe_task/assets/57904513/3e5066de-4c92-4aa2-96ad-19ab09109e50)

