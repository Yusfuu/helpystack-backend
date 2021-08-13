# helpystack

## Installation

Use the package manager [composer](https://getcomposer.org/) to install required files

Install dependencies
```bash
composer install
```
Set Environment Variables
```bash
composer run env
```

## Database Setup

Import tables from the sql file in the SQL folder 
`SQL/helpystack.sql`


## PHP built-in server
Run the following command in terminal to start localhost web server, assuming `./public/` is public-accessible directory with `index.php` file:

```bash
cd public/
php -S localhost:8000
```

##### Going to http://localhost:8000/ will render the welcome page.
## Documentation
[Documentation](https://yusfuu.github.io/Lightweight-PHP-Framework-For-APIs/)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
