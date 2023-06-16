<?php
/**
 *	oeMessage
 *  oeDispatchController Class (REST interface Fax/SMS)
 *	Copyright (c)2018 - Jerry Padgett. Padgett's Consulting
 *
 *	This program is licensed software: licensee is granted a limited nonexclusive
 *  license to install this Software on more than one computer system, as long as all
 *  systems are used to support a single licensee. Licensor is and remains the owner
 *  of all titles, rights, and interests in program.
 *
 *  Licensee will not make copies of this Software or allow copies of this Software
 *  to be made by others, unless authorized by the licensor. Licensee may make copies
 *  of the Software for backup purposes only.
 *
 *	This program is distributed in the hope that it will be useful, but WITHOUT
 *	ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 *  FOR A PARTICULAR PURPOSE. LICENSOR IS NOT LIABLE TO LICENSEE FOR ANY DAMAGES,
 *  INCLUDING COMPENSATORY, SPECIAL, INCIDENTAL, EXEMPLARY, PUNITIVE, OR CONSEQUENTIAL
 *  DAMAGES, CONNECTED WITH OR RESULTING FROM THIS LICENSE AGREEMENT OR LICENSEE'S
 *  USE OF THIS SOFTWARE.
 *
 *  @package oeMessage
 *  @version 1.0
 *  @copyright Jerry Padgett
 *  @author Jerry Padgett <sjpadgett@gmail.com>
 *  @uses Fax and Patient SMS Notifications
 *
 **/

abstract class oeDispatchController
{
    private $_request, $_response, $_query, $_post, $_server, $_cookies, $_session;
    protected $_currentAction, $_defaultModel;

    const ACTION_POSTFIX = 'Action';
    const ACTION_DEFAULT = 'indexAction';

    public function __construct()
    {
        $this->_request = &$_REQUEST;
        $this->_query = &$_GET;
        $this->_post = &$_POST;
        $this->_server = &$_SERVER;
        $this->_cookies = &$_COOKIE;
        $this->_session = &$_SESSION;
        $this->init();
    }

    public function init()
    {
        $this->dispatchActions();
        $this->render();
    }

    public function indexAction()
    {
        return null;
    }

    public function dispatchActions()
    {
        $action = $this->getQuery('action');
        if ($action && $action .= self::ACTION_POSTFIX) {
            if (method_exists($this, $action)) {
                $this->setResponse(
                    call_user_func(array($this, $action), array())
                );
            } else {
                $this->setHeader("HTTP/1.0 404 Not Found");
            }
        } else {
            $this->setResponse(
                call_user_func(array($this, self::ACTION_DEFAULT), array())
            );
        }

        return $this->_response;
    }

    public function render()
    {
        if ($this->_response) {
            if (is_scalar($this->_response)) {
                echo $this->_response;
            } else {
                throw new \Exception('Response content must be scalar');
            }

            exit;
        }
    }

    public function getRequest($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_request[$param]) ?
                $this->_request[$param] : $default;
        }

        return $this->_request;
    }

    public function getQuery($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_query[$param]) ?
                $this->_query[$param] : $default;
        }

        return $this->_query;
    }

    public function getPost($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_post[$param]) ?
                $this->_post[$param] : $default;
        }

        return $this->_post;
    }

    public function setResponse($content)
    {
        $this->_response = $content;
    }

    public function getServer($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_server[$param]) ?
                $this->_server[$param] : $default;
        }

        return $this->_server;
    }

    public function getSession($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_session[$param]) ?
                $this->_session[$param] : $default;
        }

        return $this->_session;
    }

    public function getCookie($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_cookies[$param]) ?
                $this->_cookies[$param] : $default;
        }

        return $this->_cookies;
    }

    public function setHeader($params)
    {
        if (!headers_sent()) {
            if (is_scalar($params)) {
                header($params);
            } else {
                foreach ($params as $key => $value) {
                    header(sprintf('%s: %s', $key, $value));
                }
            }
        }

        return $this;
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function setCookie($key, $value, $seconds = 3600)
    {
        $this->_cookies[$key] = $value;
        if (!headers_sent()) {
            setcookie($key, $value, time() + $seconds);
            return $this;
        }
    }
}
