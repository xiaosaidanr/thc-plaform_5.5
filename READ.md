# 说明

## 修改记录log的方式从'single'到'daily'

## 安装Bouncer
composer require silber/bouncer v1.0.0-rc.1
添加Bouncer的trait到user模型中:
'''
use Silber\Bouncer\Database\HasRolesAndAbilities;
class User extends Model
{
    use HasRolesAndAbilities;
}
'''

## php artisan make:auth

## 在.env中修改数据库相关的配置

## php artisan migrate
creat_users_table
create_password_resets_table
create_bouncer_tables

# TODO List
