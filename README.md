#Running the project
<ul>
    <li>Clone the project</li>
    <li>Go to the folder application using cd command on your cmd or terminal</li>
    <li>Run composer install on your cmd or terminal</li>
    <li>Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.</li>
    <li>Run php artisan key:generate</li>
    <li>Run php artisan migrate</li>
    <li>Run php artisan serve</li>
    <li>Go to http://localhost:8000/</li>
</ul>
