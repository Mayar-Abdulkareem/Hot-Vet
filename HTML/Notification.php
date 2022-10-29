<?php
class msgBox{

    public $title="";
    public $massage="";
    public $color="";

    function __set($name, $value)
    {
        if($name == 'massage')
            $this -> $massage = $value;
        elseif ($name == 'title')
            $this -> $title = $value;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $massage
     */
    public function setMassage($massage)
    {
        $this->massage = $massage;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function display()
    {

?>
        <style>
            .alert {
                padding: 20px;
                padding-left: 50px;
                background-color: <?php echo $this->color ?>;
                color: white;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
        </style>
        <div class="alert" id="msgBox" style = "position: absolute; top:100px; width: 100%; margin-bottom: 100px ">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong id="title"><?php echo $this->title ?></strong> <span id="msg"> <?php echo $this->massage ?> </span>
        </div>
<?php
    }
}
?>
