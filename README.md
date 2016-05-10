# Game - No Name Yet
This is the super pre Alpha version of this game.

The idea for the Alpha version is to have a backend API written in Laravel
that is consumed by some JS frontend with a super simple interface. It will
be 1 step up from text-based.

Eventually, the goal is for this to be a full-blown game, utilizing Virtual Reality.
However, I figured it I started super simple I could at least get a 'playable' version
within a few weeks.

The game won't also be open-source, but when it will change to closed-source, I have no idea.
Probably won't be for quite a while, and I won't ever delete this repository. I'll just stop
updating it will changes eventually.

## Laravel Part
Right now, there is an HTTP involved with the code. I've been using it in Tinker. I will
probably finish most of the mechanics before creating the REST API to be consumed by the front-end.

What that means for you: If you want to look at the code I've actually written, look in the
`code/laravel/app/Game` & `code/laravel/tests` directories. There currently is no Database in use.