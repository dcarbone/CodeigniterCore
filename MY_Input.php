<?php
/*
    Base MY_Input Class for CodeIgniter
    Copyright (C) 2013  Daniel Carbone (https://github.com/dcarbone)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class MY_Input extends CI_Input
{
    /**
     * Determines if this request is a JSONP request
     * regardless of validity
     *
     * @access  public
     * @return  boolean
     */
    public function is_jsonp_request()
    {
        return ($this->get("callback") !== null);
    }

    /**
     * Attempts to determine if this is a VALID JSONP request
     * Will return false if invalid, but could still be a
     * JSONP request
     *
     * @access  public
     * @return  boolean
     */
    public function is_valid_jsonp_request()
    {
        $callback = $this->get("callback");

        if (is_string($callback))
        {
            $callback = trim($callback);

            if (!preg_match("/\W/", trim($callback)))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the expected return type via the HTTP_ACCEPT header value
     *
     * @return Array
     */
    public function get_accept_types()
    {
        $accepts = explode(", ", strval($this->server("HTTP_ACCEPT")));

        $return = array();

        foreach($accepts as $a)
        {
            $return[] = strtolower($a);
        }

        return $return;
    }

    /**
     * Determines if the current request type is GET
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html  section 9.3
     *
     * @return boolean
     */
    public function is_get_request()
    {
        return $this->get_request_type() === "get";
    }

    /**
     * Determines if current request type is HEAD
     *
     * A HEAD request should only return HTTP headers,
     * no body content
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html  section 9.4
     *
     * @return boolean
     */
    public function is_head_request()
    {
        return $this->get_request_type() === "head";
    }

    /**
     * Determines if current request type is POST
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html  section 9.5
     *
     * @return boolean
     */
    public function is_post_request()
    {
        return $this->get_request_type() === "post";
    }

    /**
     * Determines if current request type is DELETE
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html  section 9.7
     *
     * @return boolean
     */
    public function is_delete_request()
    {
        return $this->get_request_type() === "delete";
    }

    /**
     * Return the type of request string
     *
     * @return String
     */
    public function get_request_type()
    {
        return strtolower(strval($this->server("REQUEST_METHOD")));
    }

    /**
     * Determines if the user agent accepts gzip'd data
     *
     * @return Boolean
     */
    public function accepts_gzip()
    {
        $accepts = $this->server("HTTP_ACCEPT_ENCODING");

        if (stristr(strval($accepts), "gzip"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */
