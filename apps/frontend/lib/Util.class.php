<?php

class Util {
  public static function currentDateInDBFormat(){
    return date('Y-m-d H:i:s');
  }

  public static function getMaxFilesize(){
    $value = ini_get('upload_max_filesize');
    $maxFileSizeInBytes = self::convertBytes($value);

    return $maxFileSizeInBytes;
  }

  protected static function convertBytes($value) {
    if ( is_numeric( $value ) ) {
      return $value;
    } else {
      $value_length = strlen( $value );
      $bytes = substr( $value, 0, $value_length - 1 );
      $unit = strtolower( substr( $value, $value_length - 1 ) );
      switch ( $unit ) {
        case 'k':
          $bytes *= 1024;
          break;
        case 'm':
          $bytes *= 1048576;
          break;
        case 'g':
          $bytes *= 1073741824;
          break;
      }

      return $bytes;
    }
  }
}