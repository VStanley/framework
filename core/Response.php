<?php

namespace core;


class Response
{
    /** возврат данных json
     *
     * @param $data
     * @return string
     */
    public function responseEncodeData($data)
    {
        return json_encode($data);
    }

}