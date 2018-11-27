<?php
/**
 * Created by Wei Chen.
 * User: go3solutions
 * Date: 11/27/18
 * Time: 1:12 PM
 */

namespace Guesl\Clover\Models\Employee;


use Guesl\Clover\Models\Clover;

class Employee extends Clover
{
    private static $employeeId;

    /**
     * Create an employee
     *
     * @param array $employeeData
     * @return mixed
     */
    public static function create($employeeData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $employee = $httpClient->post("$version/merchants/$merchantId/employees", [
            'json' => $employeeData,
        ]);

        return $employee;
    }

    /**
     * Update an employee info
     *
     * @param $employeeId
     * @param array $employeeData
     * @return mixed
     */
    public static function update($employeeId, $employeeData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $employee = $httpClient->post("$version/merchants/$merchantId/employees/$employeeId", [
            'json' => $employeeData,
        ]);

        return $employee;
    }

    /**
     * Retrieve an employee
     *
     * @param $employeeId
     * @return mixed
     */
    public static function retrieve($employeeId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $employee = $httpClient->get("$version/merchants/$merchantId/employees/$employeeId");

        return $employee;
    }

    /**
     * Fetch all employees
     *
     * @return mixed
     */
    public static function fetch()
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $employees = $httpClient->get("$version/merchants/$merchantId/employees");

        return $employees;
    }


    /**
     * Delete an employee
     *
     * @param $employeeId
     * @return mixed
     */
    public static function delete($employeeId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->delete("$version/merchants/$merchantId/employees/$employeeId");

        return $result;
    }

    /**
     * @param $employeeId
     */
    public static function setEmployeeId($employeeId): void
    {
        self::$employeeId = $employeeId;
    }

    /**
     * @return mixed
     */
    public static function getEmployeeId()
    {
        return self::$employeeId;
    }
}
