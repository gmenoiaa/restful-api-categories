# Restful-api-categories

## Installation

* Clone repository with `--recursive` flag
```
git clone git@bitbucket.org:gmenoia/restful-api-categories.git --recursive
```
* Start environment and setup scripts
```
cd ./laradock
docker-compose up -d nginx mysql
docker-compose exec --user=laradock workspace composer install
docker-compose exec --user=laradock workspace php artisan migrate:refresh
```
* Done. API documentation is available at http://localhost/api/documentation

## Test coverate results
```
Code Coverage Report:    
  2018-06-19 10:29:58    
                         
 Summary:                
  Classes: 77.78% (7/9)  
  Methods: 80.00% (16/20)
  Lines:   66.67% (46/69)

\App::Category
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% (  5/  5)
\App\Console::Kernel
  Methods: 100.00% ( 2/ 2)   Lines: 100.00% (  3/  3)
\App\Http\Controllers::CategoryController
  Methods: 100.00% ( 5/ 5)   Lines: 100.00% ( 12/ 12)
\App\Http\Middleware::ETagMiddleware
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% (  8/  8)
\App\Providers::AppServiceProvider
  Methods: 100.00% ( 2/ 2)   Lines: 100.00% (  2/  2)
\App\Providers::EventServiceProvider
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% (  2/  2)
\App\Providers::RouteServiceProvider
  Methods: 100.00% ( 4/ 4)   Lines: 100.00% ( 14/ 14)
```