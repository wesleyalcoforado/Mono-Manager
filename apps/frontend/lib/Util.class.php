<?php

class Util {

  /**
   * @param String $dbdate String que represente uma data no formato yyyy-mm-dd; se a hora for informada, ela é removida automaticamente.
   */
  public static function DBDateToTimestamp($dbdate){
    list($datepart, ) = preg_split('/ /', $dbdate);
    list($year, $month, $day) = preg_split('/-/', $datepart);

    return mktime(0, 0, 0, $month, $day, $year);
  }

  public static function currentDateInDBFormat(){
    return date('Y-m-d H:i:s');
  }

  public static function dateInDBFormat($year, $month, $day){
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    return date('Y-m-d H:i:s', $timestamp);
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