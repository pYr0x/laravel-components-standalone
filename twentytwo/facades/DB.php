<?php
/**
 * Copyright (c) 2007-2019 Julian Kern, twentytwo Solutions (http://www.22-solutions.de)
 * All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited Proprietary and confidential.
 */

namespace twentytwo\facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class db
 *
 * @method static string getDefaultConnection()
 * @method static bool insert(string $query, array $bindings = [])
 * @method static \Illuminate\Database\Query\Builder table(string $table)
 */
class DB extends Facade {

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'db'; }

}
