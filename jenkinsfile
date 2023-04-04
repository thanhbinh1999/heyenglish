pipeline {
  agent any 
  evironment {
    BUILD_SCRIPTS_GIT = "git@github.com:thanhbinh1999/heyenglish.git"
    BUILD_SCRIPTS = "heyenglish"
    BUILD_HOME = "/var/www/html/heyenglish"
  }
  states {
    stage("Checkout: Code") {
        steps {
           git  pull
        }
    }
  }
  post {
    alway {
        cleanWs()
    }
  }
}
