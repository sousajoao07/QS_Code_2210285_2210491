pipeline{
    agent any

    tools {nodejs "NodeJS"}


    parameters{
        string(name: 'SPEC', defaultValue:"cypress/integration/1-getting-started/todo.spec.js", description: "Enter the cypress script path that you want to execute")
        choice(name: 'BROWSER', choices:['electron', 'chrome', 'edge', 'firefox'], description: "Select the browser to be used in your cypress tests")
    }

    options {
            ansiColor('xterm')
    }
    
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