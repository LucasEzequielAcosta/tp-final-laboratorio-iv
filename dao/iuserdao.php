<?php
    namespace dao;

    use models\User as User;

    interface IUserDao
    {
        function Register(User $user);
        function GetAll();
        function ChangeType(User $user, $type);
        function SearchUser($name);
        function VerifyPassword(User $user);
        function FullUser(User $user);
    }
?>