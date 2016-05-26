angular.module('commentApp').controller('CommentController', function($scope, $http) {
        
    $http.get(window.location.pathname + '/comments')
    .then(function(res) {
        $scope.comments = res.data.comments;
    }, function errorCallback(res) {
        console.log(res);
        //todo error handling
    });

    $scope.submitComment = function () {
        if ($scope.commentFormData.content) {
            $http({
                method: 'post',
                url: window.location.pathname + '/comments',
                data: $.param($scope.commentFormData),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            })
                .then(function(res) {
                    $scope.commentFormData = null;
                    $scope.comments.unshift(res.data.comment);
                }, function errorCallback(res) {
                    console.log(res);
                    //todo error handling
                });
        }
    };
});