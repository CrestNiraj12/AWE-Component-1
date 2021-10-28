<?php


namespace awe;


class HtmlProductWriter extends ShopProductWriter
{

    public function write()
    {
        echo $this->htmlHeader();
        echo $this->htmlBody();
        echo '</html>';
    }

    private function htmlHeader()
    {
        return
            '<!DOCTYPE html>
            <html>
            <head>
                <title>AWE Product List</title>
                <link rel="stylesheet" href="./css/styles.css">
            </head>';
    }

    private function htmlBody()
    {
        $bookproducts = [];
        $cdproducts = [];
        $gameproducts = [];

        foreach ($this->products as $product) {
            if ($product instanceof BookProduct) $bookproducts[] = $product;
            if ($product instanceof CdProduct) $cdproducts[] = $product;
            if ($product instanceof GameProduct) $gameproducts[] = $product;
        }

        $booktable = $this->generateBookTable($bookproducts);
        $cdtable = $this->generateCdTable($cdproducts);
        $gametable = $this->generateGameTable($gameproducts);

        $addProduct = $this->generateAddProductForm();

        return
            '<body><h1>Component 1</h1>'
            . $booktable .
            '<br />'
            . $cdtable .
            '<br />'
            . $gametable .
            '<br />'
            . $addProduct .
            '</body>';
    }

    private function generateBookTable($bookproducts)
    {
        $contents = '';
        foreach ($bookproducts as $book) {
            $contents .= '<tr>
                  <td>' . $book->getFullName() . '</td>'
                . '<td>' . $book->getTitle() . '</td>'
                . '<td>' . $book->getNumberOfPages() . '</td>'
                . '<td>' . $book->getPrice() . '</td>'
                . '<td>' . '<a href="./index.php?delete=' . $book->getId() . '">X</a>' . '</td>
                </tr>';
        }
        return
            '
            <h3>BOOKS</h3>
            <table class="paleBlueRows equal-width">
                <thead>
                    <tr>
                        <th>AUTHOR</th>
                        <th>TITLE</th>
                        <th>PAGES</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            . $contents .
            '</tbody>
            </table>';
    }

    private function generateCdTable($cdproducts)
    {
        $contents = '';
        foreach ($cdproducts as $cd) {
            $contents .= '<tr>
                  <td>' . $cd->getFullName() . '</td>'
                . '<td>' . $cd->getTitle() . '</td>'
                . '<td>' . $cd->getPlayLength() . '</td>'
                . '<td>' . $cd->getPrice() . '</td>'
                . '<td>' . '<a href="./index.php?delete=' . $cd->getId() . '">X</a>' . '</td>
                </tr>';
        }
        return
            '
            <h3>CDs</h3>
            <table class="paleBlueRows equal-width">
                 <thead>
                    <tr>                    
                        <th>ARTIST</th>
                        <th>TITLE</th>
                        <th>DURATION</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            . $contents .
            '</tbody>
            </table>';
    }

    private function generateGameTable($gameproducts)
    {
        $contents = '';
        foreach ($gameproducts as $game) {
            $contents .= '<tr>
                  <td>' . $game->getFullName() . '</td>'
                . '<td>' . $game->getTitle() . '</td>'
                . '<td>' . $game->getPEGI() . '</td>'
                . '<td>' . $game->getPrice() . '</td>'
                . '<td>' . '<a href="./index.php?delete=' . $game->getId() . '">X</a>' . '</td>
                </tr>';
        }
        return
            '
            <h3>GAMES</h3>
            <table class="paleBlueRows equal-width">
                 <thead>
                    <tr>                    
                        <th>CONSOLE</th>
                        <th>TITLE</th>
                        <th>PEGI</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            . $contents .
            '</tbody>
            </table>';
    }

    private function generateAddProductForm()
    {
        return '
          <hr />
          <div class="addForm">
          <h2>ADD NEW PRODUCT</h2>
         <form action="./index.php" method="post">
         <div class="formInput">
          <label for="producttype">Product Type:</label>
          <select id="producttype" name="producttype">
                <option value="cd">CD</option>
                <option value="book">Book</option>
                <option value="game">Game</option>
          </select> 
          </div>
          <br />
         <label for="name">Author / Artist / Game:</label><br />
         <div class="formInput">
         <label for="fname">First Name:</label>
           <input type="text" id="fname" name="fname">
           </div>
           <br />
           <div class="formInput">
          <label for="sname">Main Name / Surname / Console:</label>
           <input type="text" id="sname" name="sname">
            </div>
           <br />
           <div class="formInput">
         <label for="title">Title:</label>
           <input type="text" id="title" name="title">
           </div>
           <br />
           <div class="formInput">
         <label for="pages">Pages/Duration/PEGI:</label>
           <input type="text" id="pages" name="pages">
           </div>
           <br />
           <div class="formInput">
          <label for="price">Price:</label>
           <input type="text" id="price" name="price">
           </div>
           <br />
           <br /> 
           <input type="submit" value="Submit">
        </form> 
        </div>
        ';
    }
}
