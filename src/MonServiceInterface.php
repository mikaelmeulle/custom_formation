<?php

namespace Drupal\custom_formation;

/**
 * Interface for the service "MonService"
 */
interface MonServiceInterface {
	/**
         * get a greeting message
         *
         * @return string
         *   A greeting message
         */
        public function getGreetingMessage();
}
