pipeline {
  agent any
  environment {
    BUILD_SCRIPTS_GIT = 'git@github.com:thanhbinh1999/heyenglish.git'
    BUILD_SCRIPTS = 'heyenglish'
    BUILD_HOME = '/var/www/html/projects/'
  }
  stages {
    stage('Update: Code') {
      steps {
        sh 'git pull https://github.com/thanhbinh1999/heyenglish.git master'
        sh 'cp -prv * /var/www/html/heyenglish'
      }
    }
    stage('Build: Composer') {
      steps {
        sh "cd /var/www/html/docker && docker exec -i heyenglish_php bash -c 'cd heyenglish && composer install'"
      }
    }
    stage('clear: Cache, Config') {
      steps {
        sh "cd /var/www/html/docker && docker exec -i heyenglish_php bash -c 'cd heyenglish && php artisan cache:clear && php artisan config:clear'"
      }
    }
  }
  post {
    always {
      cleanWs()
    }
    changed {
      echo "ok"
    }
  }
}
