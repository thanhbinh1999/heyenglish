pipeline {
  agent any 
  environment {
    BUILD_SCRIPTS_GIT = "git@github.com:thanhbinh1999/heyenglish.git"
    BUILD_SCRIPTS = "heyenglish"
    BUILD_HOME = "/var/www/html/heyenglish"
  }
  stages {
    stage("Checkout: Code") {
        steps {
          sh "git pull https://github.com/thanhbinh1999/heyenglish.git master"
          sh  "cd ../ && cp -a heyenglish /var/www/html/"
        }
    }
  }
  post {
    always {
        cleanWs()
    }
  }
}