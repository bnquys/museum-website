<?php
namespace Museum\Object;

class AccountRole {
    public const ROOT = 'root';
    public const ADMIN = 'admin';
    public const USER = 'user';

    public static function all(): array {
        return [self::ROOT, self::ADMIN, self::USER];
    }
}
?>