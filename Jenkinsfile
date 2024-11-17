pipeline {
    agent any
    options {
      timestamps()
    }
    environment {
      CI = 'true'
    }
    stages {
        stage("Init") {
            steps {
                sh "make init"
            }
        }
        stage("Validate") {
            steps {
                sh "make doctrine-schema-validate"
            }
        }
        stage("Lint") {
            parallel {
                stage("API") {
                    steps {
                        sh "make api-lint"
                    }
                }
                stage("Frontend") {
                    steps {
                        sh "make frontend-eslint"
                    }
                }
                stage("Cucumber") {
                    steps {
                        sh "make cucumber-lint"
                    }
                }
            }
        }
        stage("Down") {
            steps {
                sh "make docker-down-clear"
            }
        }
    }
    post {
        always {
            sh "make docker-down-clear || true"
        }
    }
}
