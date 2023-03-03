import boto3

def lambda_handler(event, context):

    # Create an SNS client to send notification
    sns = boto3.client('sns')

    # Format text message from data
    message_text = "Upload feito para o S3."

    # Publish the formatted message
    response = sns.publish(
            TopicArn = 'arn:aws:sns:sa-east-1:488224884585:CloudSecMG',
            Message = message_text
        )

    return response
 
'''import json
import boto3

client = boto3.client('sns')

def lambda_handler(event, context):
    #print(json.dumps(event))
    EventName = event['Records'][0]['eventName']
    BucketName = event['Records'][0]['s3']['bucket']['name']
    ObjectName = event['Records'][0]['s3']['object']['key']
    
    
    response = client.publish(
    TopicArn='arn:aws:sns:sa-east-1:488224884585:CloudSecMG',
    Message='The triggered event is {}.The bucket is {}. And, the file name is{}'.format(EventName, BucketName, ObjectName),
    Subject='upload-notification',
 
    MessageStructure='string',
    MessageAttributes={
        'String': {
            'DataType': 'String',
            'StringValue': 'String'
        }
            
    },
) '''
