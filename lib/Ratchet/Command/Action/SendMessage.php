<?php
namespace Ratchet\Command\Action;
use Ratchet\Command\CommandInterface;
use Ratchet\SocketInterface;

/**
 * Send text back to the client end of the socket(s)
 */
class SendMessage implements CommandInterface {
    /**
     * @var SocketInterface
     */
    public $_socket;

    /**
     * @var string
     */
    protected $_message = '';

    public function __construct(SocketInterface $socket) {
        $this->_socket = $socket;
    }

    /**
     * The message to send to the socket(s)
     * @param string
     */
    public function setMessage($msg) {
        $this->_message = (string)$msg;
        return $this;
    }

    /**
     * Get the message from setMessage()
     * @return string
     */
    public function getMessage() {
        return $this->_message;
    }

    /**
     * @throws \UnexpectedValueException if a message was not set with setMessage()
     */
    public function execute() {
        if (empty($this->_message)) {
            throw new \UnexpectedValueException("Message is empty");
        }

        $this->_socket->write($this->_message, strlen($this->_message));
    }
}