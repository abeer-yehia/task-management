# To-Do Application 


# Objective

> Build a To-Do application that allows users to manage tasks, track priorities, mark tasks as completed, and automatically handle overdue tasks, with sorting functionality by priority and due date.



## Installation



```bash
git clone https://github.com/abeer-yehia/task-management.git
```


```bash
cd task-management
```

```bash
composer install
```

-   Copy .env.example file into .env file and configure based on your environment

```bash
cp .env.example .env
```

-   Generate encryption key

```bash
php artisan key:generate
```

-   Migrate the database

```bash
php artisan migrate
```

-   Seed database
    ```bash
    php artisan db:seed
    ```
-   Install npm dependancies

```bash
npm install
```



```bash
npm run dev
```

```bash
php artisan serve
```


``` 
 The application will be accessible at http://127.0.0.1:8000

