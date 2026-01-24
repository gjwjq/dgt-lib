<?php
    function alert($e) {
        echo "<script>alert('$e')</script>";
    }
    function move($e) {
        echo "<script>location.href='$e'</script>";
    }
    function back($e) {
        echo "<script>
        alert('$e')
        history.back()
        </script>";
    }