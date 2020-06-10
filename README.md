# songclip-plus

songclip-plus is web application edition of [songclip](https://github.com/jamband/songclip).  
(including CLI application)

![png](https://jamband.github.io/images/songclip-plus.png)

## Requirements

- MacOS >= Yosemite 
- PHP >= 7.2.0
- Composer
- Node.js (npm) 12.x
- SQLite 3
- iTunes

## Usage

```
git clone https://github.com/jamband/songclip-plus.git
cd songclip-plus
composer run dev
# or composer run dev-cli-only
cp .env.example .env
touch db/app.db
php yii migrate
php yii serve
```

and access http://localhost:8080/ on web browser.
