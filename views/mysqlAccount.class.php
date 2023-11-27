<?php
require_once('../account/account.class.php');
require_once('mysql.class.php');

/**
 * @autor       Lemiere Erwan
 * @date        25/10/2022
 * @version     1.1
 * The class MysqlAccount herited of Mysql communique with the database to get, add, update and delete account.
 * 
 * newAccount()        Initialise new Account object
 * saveAccount()       Add or update Account to database
 * exists()            Check if Account exist in database
 * getAccount()        Get one Account from id's
 * getAccounts()       Get all Accounts from database
 * deleteAccount()     Delete Account from database
 */
class MysqlAccount extends Mysql
{

    /**
     * 
     */
    function newAccount($informations)
    {

        /** Return variable */
        $account = null;

        if (($informations != null)) {
            $account = new Account();
            $account->setId($informations['id']);
            $account->setFirstName($informations['firstName']);
            $account->setName($informations['name']);
            $account->setPermission(2);
            $account->setMail($informations['mail']);
            $account->setPassword($informations['password']);
        }
        return $account;
    }


    /**
     * Add Account in database
     * @param $informations Array containing all account informations [name,account,phone,webSite,address,album,contact]
     * @return Boolean true if account is added
     */
    function addAccount($informations)
    {

        /** Return variable */
        $add = false;

        if (!empty($informations['mail'])) {

            $exists = $this->exists($informations['mail']);

            if (!$exists) {

                /** Built request INSERT INTO */
                $Qbegin = "INSERT INTO Account ";
                $Qtitles  = "(firstName,name,permission,mail,password) ";
                $Qvalues  = "VALUES (\"" . $informations['firstName'] . "\",";
                $Qvalues  .= "\"" . $informations['name'] . "\",";
                $Qvalues  .= "\"" . $informations['permission'] . "\",";
                $Qvalues  .= "\"" . $informations['mail'] . "\",";
                $Qvalues  .= "\"" . $informations['password'] . "\")";

                /** add data */
                $add = $this->add($Qbegin . $Qtitles . $Qvalues);
            }
        }

        return $add;
    }

    /**
     * Update account in database
     * @param $informations Array containing all account informations [firstName,name,permission,mail,password]
     * @return Boolean true if account is updated
     */
    function updateAccount($informations)
    {

        /** Return variable */
        $update = false;

        if (!empty($informations['id'])) {

            $exists = $this->exists($informations['mail']);

            if (!$exists) {

                /** Built request UPDATE */
                $Qbegin = "UPDATE Account SET ";

                $Qvalues = "";
                if ($informations['firstName'] != "") {
                    $Qvalues  = "firstName=\"" . $informations['firstName'] . "\" ,";
                }

                if ($informations['name'] != "") {
                    $Qvalues  .= " name=\"" . $informations['name'] . "\" ,";
                }

                if ($informations['permission'] != "") {
                    $Qvalues  = " permission=\"" . $informations['permission'] . "\" ,";
                }

                if ($informations['mail'] != "") {
                    $Qvalues  .= " mail=\"" . $informations['mail'] . "\" ,";
                }

                if ($informations['password'] != "") {
                    $Qvalues  = " password=\"" . $informations['password'] . "\" ,";
                }
                $Qvalues = trim($Qvalues, ",");

                $Qwhere = "WHERE id=" . $informations['id'];

                /** add data */
                $update = $this->add($Qbegin . $Qvalues . $Qwhere);
            }
        }

        return $update;
    }

    /**
     * Research if account exist in database
     * @param $accountMail Name of the account to research
     * @return Account Return one Account object with the existing account data
     * @return null if the account doesn't exist
     */
    function exists($accountMail)
    {

        /** Return Variable */
        $exist = false;

        if (!empty($accountMail)) {

            /** SELECT request */
            $Qbegin = "SELECT id FROM Account ";
            $Qwhere = "WHERE mail='" . $accountMail . "' ";

            /** Send request */
            $data = $this->search($Qbegin . $Qwhere);

            if (isset($data[0])) {
                $exist = true;
            }
        }

        return $exist;
    }


    /**
     * Get account from database
     * @param $accountId The ID of the account to get from database
     * @return account Return account object with the account data search
     * @return null if the account doesn't exist
     */
    function getAccount($accountId)
    {

        /** Return Variable */
        $account = null;

        if (!empty($accountId)) {

            // SELECT CLAUSE
            $Qbegin = "SELECT id,firstName,name,permission,mail,password FROM account ";
            $Qwhere = "WHERE id=" . $accountId;

            /** Send request */
            $data = $this->search($Qbegin . $Qwhere);

            if ($data != null && sizeof($data) > 0) {
                $account = $this->newAccount($data[0]);
            }
        }
        return $account;
    }


    /**
     * Get all accounts from database
     * @param $order_field The order of field (default value is "name")
     * @param $order_direction The direction of field (default value is "asc")
     * @param $offset The research offset (default value is 0)
     * @param $length The research length (default value is 0)
     * @return account Return account object with the account data search
     * @return null if the account doesn't exist
     */
    function getAccounts($order_field = "name", $order_direction = "asc", $offset = 0, $length = 0)
    {

        /** Return variable */
        $accounts = array();

        /** SELECT CLAUSE **/
        $Qbegin     = "SELECT id,firstName,name,permission,mail,password FROM Account ";
        $Qorder     = null;
        $Qlimit     = null;

        /** ORDER BY **/
        if ($order_field != null) {
            $Qorder = " ORDER BY $order_field $order_direction";
        }

        /** LIMIT */
        if ($length > 0) {
            $Qlimit = " LIMIT $offset,$length";
        } else
        if ($offset > 0) {
            $Qlimit = " LIMIT $offset";
        }

        /** Get accounts **/
        $data = $this->search($Qbegin . $Qorder . $Qlimit);
        if ($data != null && sizeof($data) > 0) {

            foreach ($data as $temp_data) {
                $accounts[] = $this->newAccount($temp_data);
            }
        }
        return $accounts;
    }


    /**
     * Delete account from data base
     * @return boolean True if delete success
     */
    function deleteAccount($accountId)
    {

        /** Return variable */
        $delete = false;

        if (!empty($accountId)) {

            /** Build request DELETE */
            $Qbegin = "DELETE FROM `Account` ";
            $Qwhere = "WHERE id=" . $accountId;

            /** Delete data from database **/
            $delete = $this->delete($Qbegin . $Qwhere);
        }

        return $delete;
    }
}
