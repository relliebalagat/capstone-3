    <!-- <script src="/js/app.js"></script> -->
    <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-resource@1.2.0/dist/vue-resource.min.js"></script>
    <script>

        window.onload = function() {
            var main =  new Vue({
                el: '#main',
                data: {
                    username: '{{ $users->username }}',
                    isFollowing: {{ $is_following ? 1 : 0 }},
                    followBtnTextArr: ['Follow', 'Unfollow'],
                    followBtnText: ''
                },
                methods: {
                    follows: function (event) {
                        var csrfToken = Laravel.csrfToken;
                        var url = this.isFollowing ? '/unfollows' : '/follows';
                        this.$http.post(url, {
                            'username': this.username
                        }, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        })
                        .then(response => {
                            var data = response.body;
                            if (!data.status) {
                                alert(data.message);
                                return;
                            }
                            this.toggleFollowBtnText();
                        });
                    },
                    toggleFollowBtnText: function() {
                        this.isFollowing = (this.isFollowing + 1) % this.followBtnTextArr.length;
                        this.setFollowBtnText();
                    },
                    setFollowBtnText: function() {
                        this.followBtnText = this.followBtnTextArr[this.isFollowing];
                    }
                },
                mounted: function() {
                    this.setFollowBtnText();
                }
            });
        }
       
    </script>