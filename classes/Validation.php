<?php

  //新規、更新フォームのバリデーション
  class validation {

    // 問題のバリデーション
    public function questionValidate($questions) {

      if (empty($questions['question'])) {
        exit('問題を入力して下さい');
      }
    
      if (mb_strlen($questions['question']) > 500) {
        exit('500文字以下で入力してください');
      }
    
    }

    public function answerValidate($answers) {

      // 答えのバリデーション
      if (empty($answers['answer'])) {
        exit('答えを入力して下さい');
      }
    
      if (mb_strlen($answers['answer']) > 200) {
        exit('200文字以下で入力してください');
      }
    
    }
  }

?>