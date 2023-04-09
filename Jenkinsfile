pipeline {
  agent any 
  environment {
    BUILD_SCRIPTS_GIT = "git@github.com:thanhbinh1999/heyenglish.git"
    BUILD_SCRIPTS = "heyenglish"
    BUILD_HOME = "/var/www/html/projects/"
  }
  stages {
    stage("Checkout: Code") {
        steps {
          sh "git pull https://github.com/thanhbinh1999/heyenglish.git master"
          sh  " cd /var/www/html/docker && ls -l && docker exec -it heyenglish bash && ls -l"
        }
    }
  }
  post {
    always {
        cleanWs()
    }
  }
}
