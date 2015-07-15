<?php
class variable
{
	private $pointsDruid =""; //points gagnés en tant que druide

	private $loosePointsDevin =""; //points perdus en cas de triche

	private $highscore =""; //affichage des X meilleurs scores
	
	private $highscoreOver = ""; //affichage des scores des $highscoreOver devant et derrière le user 

	public function getPointsDruide(){
		$this->pointsDruid = 10;
		return $this->pointsDruid;
	}
	public function getloosePointsDevin(){
		$this->loosePointsDevin=5;
		return $this->loosePointsDevin;
	}
	public function gethighscore(){
		$this->highscore = 5;
		return $this->highscore;
	}	
	public function gethighscoreOver(){
		$this->highscoreOver = 2;
		return $this->highscoreOver;
	}	
}
?>