<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/15/20
 * Time: 10:48 AM
 */

namespace App\Services;

use App\Book;
use App\Traits\serviceResponseTrait;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class BasketService
{
    use serviceResponseTrait;
    protected $session;
    protected $bookService;


    public function __construct(Store $session, BookService $bookService)
    {

        $this->session = $session;
        $this->bookService = $bookService;
    }

    public function getBasketBook()
    {
        $ids = $this->session->get('ids');
        if (!$ids || empty($ids)) {
            return $this->success([]);
        }
        $books = $this->bookService->getBooksByIds($ids);
        $booksData = [];
        foreach ($books as $book) {
            $booksData[] = [
                'name' => $book->name,
                'id' => $book->id
            ];
        }
        return $this->success($booksData);

    }


    public function addToBasket($id)
    {
        $book = $this->bookService->getBookById($id);

        if (!$book) {

            return $this->error(404, "not found");
        }
        $ids = $this->session->get('ids');
        if (!$ids || empty($ids)) {
            $ids = [];
            $ids[] = $id;
        } else {
            if (!in_array($id, $ids)) {
                $ids[] = $id;
            }
        }
        $this->session->put('ids', $ids);
        return $this->success([]);

    }

    public function deleteFromBasket($id)
    {
        $book = $this->bookService->getBookById($id);

        if (!$book) {

            return $this->error(404, "not found");
        }

        $ids = $this->session->get('ids');
        if (!$ids || empty($ids)) {
            $ids = [];
            $ids[] = $id;
        } else {
            if (!in_array($id, $ids)) {
                $ids[] = $id;
            }
        }
        foreach ($ids as $key => $value){
            if ($value == $id){
                unset($ids[$key]);
            }
        }
        $this->session->put('ids', $ids);
        return $this->success([]);


    }

    public function removeBasket()
    {
        $this->session->remove('ids');
    }
}
