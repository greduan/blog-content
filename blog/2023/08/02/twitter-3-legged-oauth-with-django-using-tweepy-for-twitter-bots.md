---
title: Twitter 3-legged OAuth With Django Using Tweepy, for Twitter Bots
layout: blogpost
date: 2023-08-02
---

A reference blog post on how to gain access to a Twitter account, from a Django application, for use in a Twitter bot either in Django or in some other system.

This is true as of June 2023. I hope it doesn't change, because I don't like complex OAuth flows with blackbox errors.

## Necessary Twitter auth config

```
TWITTER_API_BEARER_TOKEN=''
TWITTER_CONSUMER_API_KEY_SECRET=''
TWITTER_CONSUMER_API_KEY=''
```

The `TWITTER_API_BEARER_TOKEN` is optional, it's for being able to use certain APIs. Use it if you need it.

The other two keys you will need fort he OAuth to be able to take place.

In the Twitter Developer Portal, you find them under your project's "Keys and tokens", named "Consumer Keys", the "API Key and Secret".

> Think of these as the user name and password that represents your App when making API requests.

## Suggested Django model

```python
class YourModel(models.Model):
    twitter_oauth_token = models.CharField(max_length=256, null=True)
    twitter_oauth_token_secret = models.CharField(max_length=256, null=True)
    twitter_access_token = models.CharField(max_length=256, null=True)
    twitter_access_token_secret = models.CharField(max_length=256, null=True)

    def get_tweepy_client(self):
        return tweepy.Client(
            bearer_token=os.environ.get('TWITTER_API_BEARER_TOKEN'),
            consumer_key=os.environ.get('TWITTER_CONSUMER_API_KEY'),
            consumer_secret=os.environ.get('TWITTER_CONSUMER_API_KEY_SECRET'),
            access_token=self.twitter_access_token,
            access_token_secret=self.twitter_access_token_secret,
        )
```

**`twitter_oauth_token` and `twitter_oauth_token_secret`**

During the OAuth process, you will define the `twitter_oauth_token` and `twitter_oauth_token_secret` in the model. _You need to store somewhere persistent between requests, as you will need it to be present between two different requests._

In the end, how you keep this persistent from one request to the other is unimportant, I decided to do it through the model as it's a simple solution.

**`twitter_access_token` and `twitter_access_token_secret`**

These store the final auth keys you get from Twitter to forever represent this user via your Twitter bot.

## Django endpoints (`urls.py`)

```python
urlpatterns = [
    path('authenticate_twitter', login_required(views.authenticate_twitter), name='authenticate_twitter'),
    path('authenticate_twitter_callback/', login_required(views.authenticate_twitter_callback), name='authenticate_twitter_callback'),
]
```

## Django endpoints (`views.py`)

```python
def authenticate_twitter(request):
    model_id = request.GET.get('model_id')
    oauth1_user_handler = get_oauth1_user_handler(model_id)
    url = oauth1_user_handler.get_authorization_url(signin_with_twitter=True)
    model = YourModel.objects.get(id=model_id)
    model.twitter_oauth_token = oauth1_user_handler.request_token['oauth_token']
    model.twitter_oauth_token_secret = oauth1_user_handler.request_token['oauth_token_secret']
    model.save()
    return redirect(url)


def authenticate_twitter_callback(request):
    model_id = request.GET.get('model_id')
    # oauth_token = request.GET.get('oauth_token')
    oauth_verifier = request.GET.get('oauth_verifier')
    oauth1_user_handler = get_oauth1_user_handler(model_id)
    access_token, access_token_secret = oauth1_user_handler.get_access_token(oauth_verifier)

    model = YourModel.objects.get(id=model_id)
    model.twitter_access_token = access_token
    model.twitter_access_token_secret = access_token_secret
    model.save()

    return redirect('/yourapp/' + str(model_id))


def get_oauth1_user_handler(model_id: str):
    model = YourModel.objects.get(id=model_id)
    oauth1_user_handler = tweepy.OAuth1UserHandler(
        consumer_key=os.environ.get('TWITTER_CONSUMER_API_KEY'),
        consumer_secret=os.environ.get('TWITTER_CONSUMER_API_KEY_SECRET'),
        callback=f'{os.environ.get("HOST")}/yourapp/authenticate_twitter_callback/?model_id={model_id}'
    )
    if model.twitter_oauth_token_secret is not None and model.twitter_oauth_token_secret != '':
        oauth1_user_handler.request_token = {
            'oauth_token': model.twitter_oauth_token,
            'oauth_token_secret': model.twitter_oauth_token_secret
        }
    return oauth1_user_handler
```

**`authenticate_twitter_get(request)`**

When the user visits the URL, they will be redirected to Twitter for the OAuth interaction for your bot.

Before redirecting the user, we save the `twitter_oauth_token` and `twitter_oauth_token_secret` because we will need it.

**`authenticate_twitter_callback(request)`**

It finishes the authentication process, by getting the access tokens and storing them in the model.

These can now be used to instantiate a Tweepy client that has access to the Twitter API and can manipulate stuff on behalf of the account that accepted the bot's OAuth.

**`get_oauth1_user_handler(model_id: str)`**

Just a helper function. You can use it or not, up to you.

It sets the `oauth_token` and `oauth_token_secret` to be the `twitter_oauth_token` and `twitter_oauth_token_secret` if it exists in the model.

This complexity could've been in the `authenticate_twitter_callback(request)` as well.

_This step is not very well documented by Tweepy. It somehow assumes it all happens in the same context. It does mention it, but it's not very clear._ I hope this alone saves you a couple hours.

**Nota bene:** In my code I use the `HOST` environment variable, you can hardcode this or use whatever other medium you have to define the host of the server.

**Nota bene 2:** The `callback` URL needs to be configured in your Twitter bot's config to be a valid ["Callback / Redirect URI"](https://developer.twitter.com/en/docs/apps/callback-urls).

## The user's entrypoint

Simply send them to the URL for the `authenticate_twitter(request)` endpoint, and that starts the interaction for the user.

## In conclusion

The integration itself is rather straightforward, you just need to play around until you magically come across the correct solution of what values to pass where and which states to save and pass around and which not :)

I _am_ a bit salty at how long it took to figure this out.

## Resources

- [Tweepy docs for 3-legged OAuth](https://docs.tweepy.org/en/latest/authentication.html?#legged-oauth)