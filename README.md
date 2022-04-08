# BTS GSB

## Installation Laravel

1. Install Composer packages
   ```sh
   composer install
   ```
2. Copy the environment file & edit it accordingly
   ```sh
   cp .env.example .env
   ```

3. Generate application key
   ```sh
   php artisan key:generate
   ```

5. Linking Storage folder to public
   ```sh
   php artisan storage:link
   ```

6. Compile all your assets including a source map
   ```sh
   npm install && npm run dev
   ```

7. Serve the application
   ```sh
   php artisan serve
   ```

## CREATE DATABASE 

1. Login to mysql
   ```sh
   mysql -u yourUsername -p yourPassword

2. Create database and select this
   ```sh
   CREATE DATABASE gsb && use gsb
   ```

3. Import sql to database 
   ```sh
   source database-gsb.sql
   ```
