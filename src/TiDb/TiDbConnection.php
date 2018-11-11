<?php

namespace Evvo\TiDb;

use Illuminate\Database\MySqlConnection;

class TiDb extends MySqlConnection
{
    public function statement($query, $bindings = [])
    {
        return $this->run($query, $bindings, function ($query, $bindings) {
            if ($this->pretending()) {
                return true;
            }

            // TiDB cannot prepare query which does not include prepared binding parameters
            if(empty($bindings)) {
                return $this->getPdo()->exec($query);
            }

            $statement = $this->getPdo()->prepare($query);

            $this->bindValues($statement, $this->prepareBindings($bindings));

            $this->recordsHaveBeenModified();

            return $statement->execute();
        });
    }
}
