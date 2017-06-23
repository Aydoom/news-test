<?php 

namespace PAuth\Core;

/**
 * We need two tables in the DB:
 * 'user' from migration
 * 'user_group' from migration
 * in 'user_group' we will have two record: [1, admin], [2, user], [3, guest]
 */

class DB extends \PDO {
    
    static public $db;
    
    /**
     * Connect
    */
    static public function connect($config) {
        $connect = $config['driver'] . ':host=' . $config['host']
            . ';dbname=' . $config['dbname'];
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        
        try {
            self::$db = new static($connect, $config['user'], 
                                                $config['password'], $options);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
    
    static public function createUser($user, $psw, $group) {
        $query = sql_placeholder(
                'insert into user(user, password, id_user_group) values(?, ?, ?)', 
                $user, $psw, $group);
        return (self::$db->query($query));
    }
    
    static public function saveUserToken($userId) {
        $query = self::$db->prepare(
            'UPDATE `user` SET `token` = ?'
            . ' WHERE `user`.`id` = ?');
        
        return $query->execute([Cookie::getUserToken(), $userId]);
    }
    
    static public function getUserByToken($id, $token) {
        //pr([$id, $token], false);
        $query = self::$db->prepare(
            'SELECT `user`.*, `user_group`.`type` as `type_group`, '
                . '`user_group`.`level` as `level_group`'
                . ' FROM `user` LEFT JOIN `user_group`'
                . ' ON `user`.`id_user_group` = `user_group`.`id`'
                . ' WHERE `user`.`id` = ?'
                . ' AND `user`.`token` = ?'
                . ' LIMIT 1');
        $query->execute([$id, $token]);
        //pr($query);
        $user = $query->fetchAll();

        return $user[0];
    }
    
    static public function getUserByPsw($name, $password) {
        $query = self::$db->prepare(
            'SELECT `user`.*, `user_group`.`type` as `type_group`, '
                . '`user_group`.`level` as `level_group`'
                . ' FROM `user` LEFT JOIN `user_group`'
                . ' ON `user`.`id_user_group` = `user_group`.`id`'
                . ' WHERE `user`.`name` = ?'
                . ' AND `user`.`password` = ?'
                . ' LIMIT 1');
        $query->execute([$name, md5(md5($password))]);
        
        $user = $query->fetchAll();
        //pr([$name, [$password, md5(md5($password))], $user]);
        return $user[0];
    }}