## Laravel Surplus Test

This is a simple API for managing products and their categories and images, built with Laravel.

### Requirements
- PHP 7.4 or newer
- Composer
- MySQL 5.7 or newer

### Installation
1. Clone this repository:

```bash
git clone https://github.com/hafizhpratama/surplus_test.git
```


2. Navigate to the project directory:

```bash
cd surplus_test
```


3. Install dependencies:

```bash
composer install
```


4. Copy the example environment file and modify the necessary values:

```bash
cp .env.example .env
```


5. Generate a new application key:

```bash
php artisan key:generate
```


6. Create a new database and update the `DB_DATABASE` value in the `.env` file with the name of the new database.

7. Migrate the database tables:

```bash
php artisan migrate
```


8. Seed the database with some example data:

```bash
php artisan db:seed
```

### Usage

The API has the following endpoints:

#### Category

- `GET /api/v1/categories`: Get a list of all categories

- `POST /api/v1/categories`: Create a new category

- `GET /api/v1/categories/{id}`: Get details for a single category

- `PUT /api/v1/categories/{id}`: Update a category

- `DELETE /api/v1/categories/{id}`: Delete a category

#### Product

- `GET /api/v1/products`: Get a list of all products

- `POST /api/v1/products`: Create a new product

- `GET /api/v1/products/{id}`: Get details for a single product

- `PUT /api/v1/products/{id}`: Update a product

- `DELETE /api/v1/products/{id}`: Delete a product

#### Image

- `GET /api/v1/images`: Get a list of all images

- `POST /api/v1/images`: Create a new images

- `GET /api/v1/images/{id}`: Get details for a single images

- `PUT /api/v1/images/{id}`: Update a images

- `DELETE /api/v1/images/{id}`: Delete a images

### API Payload
#### Category
```bash
{
  "name": "Shirts",
  "enable": true
}
```

#### Product
```bash
{
  "name": "T-Shirt",
  "description": "A comfortable t-shirt for everyday wear",
  "enable": true
}
```

#### Image
```bash
{
  "name": "Jeans Image",
  "file": "jeans.jpg",
  "enable": true,
}
```

#### Product with Category
```bash
{
  "name": "T-Shirt",
  "description": "A comfortable t-shirt for everyday wear",
  "enable": true,
  "category": "Shirts" //Category Name
}
```

#### Product with Image
```bash
{
  "name": "T-Shirt",
  "description": "A comfortable t-shirt for everyday wear",
  "enable": true,
  "image": "T-Shirt image" //Image Name
}
```

#### Product with Category and Image
```bash
{
  "name": "T-Shirt",
  "description": "A comfortable t-shirt for everyday wear",
  "enable": true,
  "category": "Shirts" //Category Name
  "image": "T-Shirt image" //Image Name
}
```

### License

The Laravel framework is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).