<?php

class Request {

  /**
   * Settings sending to the request
   */
  private $settings;

  public function __construct(array $settings) {
    $this->settings = $settings;
  }

  /**
   * Check if settings exists
   * @param String name of setting
   * @return Bool 
   */
  public function issetSettings(string $name) {
    return (isset($this->settings[$name]) && $this->settings[$name] !== "");
  }

  /**
   * Get the value of asked settings
   * @param String name of setting
   * @return String : value of asked settings
   */
  public function getSettings(string $name) {
    if ($this->issetSettings($name)) {
      return $this->settings[$name];
    }
    else
      throw new Exception("Paramètre '$name' absent de la requête");
  }
}