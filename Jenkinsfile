pipeline {
  agent any 
  environment {
    BUILD_SCRIPTS_GIT = "git@github.com:thanhbinh1999/heyenglish.git"
    BUILD_SCRIPTS = "heyenglish"
    BUILD_HOME = "/var/www/html"
  }
  stages {
    stage("Checkout: Code") {
        steps {
          sh "git pull https://github.com/thanhbinh1999/heyenglish.git master"
          sh  "cd heyenglish && cp -prv .git /var/www/html/project/heyenglish"
        }
    }
  }
  post {
    always {
        cleanWs()
    }
  }
}
