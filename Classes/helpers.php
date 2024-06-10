<?php

namespace tours;

class Helpers
{
    public function checkMD($data)
    {
        $data = (int)$data;
        return $data > 0 ? $data : 4;
    }

    public function starGenerator($n)
    {
        return str_repeat('<i class="fa fa-star"></i>', $n);
    }

    public function checker($value)
    {
        return (int)$value === 1 ? "✅" : "❌";
    }

    public function divClassGenerator($list)
    {
        foreach ($list as $item) {
            echo '<div class="' . $item . '">';
        }
    }

    public function divCloser($n)
    {
        echo str_repeat('</div>', $n);
    }
}
?>
