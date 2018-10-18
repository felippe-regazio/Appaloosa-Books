<?php

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

class BooksTable extends Table
{
	/* 
		Global var, init methods and Associations
	*/
    public function initialize(array $config)
    {
		$this->belongsTo('authors')
			->setConditions('books.author_id = authors.author_id');
		
		$this->belongsTo('reviewers')
			->setConditions('reviewers.id = books.reviewer_id');

		$this->belongsTo('genders')
			->setConditions('genders.id = books.gender_id');			
    }


    /*
      =====================================================================
		BOOK LIST AND SEARCH BOOKS TABLE METHODS - USED BY AJAX GET BOOKS
      =====================================================================
    */

	public function listAllAvailable(){
		$result = $this->find()
		->contain(["authors", "reviewers", "genders"])
		->where(["status" => 1])
		->where(["authors.author_status" => 1]);
		return $result;
	}	
	/* 
		Get all books accepting params, the params
		could be a Gender, a Search String, o both.
		If Gender and Search strings are empty, the
		listAllAvailable method results will be returned.
	*/
	public function listAllAvailableWith( $params = [] ){

		$terms = $params["search"];
		$gender = ( ! empty($params["gender"]) ?  ["genders.name" => $params["gender"]] : "" );

		/* 
			this is the search method, it mounts a string
			containing the author first and last name and
			the book title and perform an sql LIKE on it

			if was passed the gender, it will be added on
			the first where condition, or will be empty

			if terms and gender was not passed, will return
			a new query with all the values
		*/
		if( !empty($terms) || !empty($gender) ){
			$result = $this->find()
				->contain(["authors", "reviewers", "genders"])
				->where(["status" => 1])
				->where(["authors.author_status" => 1])
				->where( $gender )
				->where(
					function ($exp, $query) use ($terms) {
						$conc = $query->func()->concat([
							'authors.author_first_name' => 'identifier', ' ',
							'authors.author_last_name' => 'identifier', ' ',
							'title' => 'identifier'
						]);
						return ( !empty($terms) ? $exp->like($conc, '%'.$terms.'%') : "" );
			    	}
				);
		} else{
			$result = $this->listAllAvailable();
		}
		
		return $result;
	}

	/*
		Get all book data with contains in the same pattern
		as listAllAvailableWith but brings by asbn
	*/
	public function listAllAvailableWithByAsbn( $asbn ){
		if( !empty($asbn) ){
			$result = $this->find()
				->contain(["authors", "reviewers", "genders"])
				->where(["status" => 1])
				->where(["authors.author_status" => 1])
				->where(["asbn" => $asbn]);
		} else {
			$result = null;
		}
		return $result;
	}

    /*
      =====================================================================
		GENERAL BOOKS TABLE METHODS
      =====================================================================
    */

	public function listAll(){
		$result = $this->find()
		->contain(["authors", "reviewers", "genders"])
		->all();
		return $result;
	}

	public function getAllBookDataById($id){
		$query = $this->get($id);
        return $query;
	}

	public function incView( $asbn ){
		$query = $this->query();
		$this->query()->update()
			->set($query->newExpr('views = views + 1'))
			->where(["asbn"=>$asbn])
			->execute();
	}

	public function updateBookData( $data, $id ){
        $this->query()->update()
        ->set( $data )
        ->where(['id'=>$id])
        ->execute();
	}

	public function getBestSellers(){
		$result = $this->find()
			->contain(["authors", "reviewers", "genders"])
			->order(["views" => "desc"])
			->limit(7)
			->all();
		return $result;
	}

	public function getBooksCount(){
		$result = $this->find()
			->select("views")
			->sumOf("views");
		return $result;
	}	
}

?>