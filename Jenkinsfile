pipeline{
    agent any

    stages {
        stage('Build/Deploy app to staging') {
            steps {
                sshPublisher(
                    publishers: [sshPublisherDesc(
                        configName: 'staging', 
                        transfers: [
                            sshTransfer(
                                cleanRemote: false, 
                                excludes: 'node_modules/', 
                                execCommand: '''
                                cd /var/www/frutos
                                npm install
                                composer install
                                npm run prod ''', 
                                execTimeout: 120000, 
                                flatten: false, 
                                makeEmptyDirs: false, 
                                noDefaultExcludes: false, 
                                patternSeparator: '[, ]+', 
                                remoteDirectory: '', 
                                remoteDirectorySDF: false, 
                                removePrefix: '', 
                                sourceFiles: '**/*')],             
                usePromotionTimestamp: false, 
                useWorkspaceInPromotion: false, 
                verbose: true)])
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