# BullyAPI
Custom API for Twitch bots.

----------
Warning: 
----------
"MATURE" CONTENT.
This API should be used in non-civilized Twitch channels. The output is a random insult towards requested user.

Usage (for Nightbot):
----------
```!commands add !bully $(urlfetch YOUR_URL/?u=$(1))```

`$(urlfetch x)` - custom API, where x is your URL, e.g. `http://example.com/?u=user`

`/?u=$(1)` - chat variable, where $(1) is your string, e.g. `!bully username`

!bully command name is optional
