pipeline{
    agent any
    stages {
        stage('Build/Deploy app to staging') {
            steps {
                // One or more steps need to be included within the steps 
block.
                echo 'Building/Deploying app to staging'
            }
        }
        stage('Run automated tests') {
            steps {
                echo 'Running automated tests'
            }
        }
        stage('Perform manual testing') {
            steps {
                echo 'Performing manual testing '
            }
        }
        stage('Release to production') {
            steps {
                echo 'Releasing to production'
            }
        }
    }
}
