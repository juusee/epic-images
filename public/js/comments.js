
var Comment = React.createClass({
    render: function() {
        return (
            <li>
                <div className="commentText">
                    <a className="commenter" href={'/user/' + this.props.user}>
                        {this.props.user}
                    </a>
                    <p>{this.props.children}</p>
                </div>
            </li>
        )
    }
});

var CommentList = React.createClass({
  render: function() {
      var commentNodes = this.props.data.map(function(comment) {
          return (
              <Comment user={comment.user} key={comment.id}>
                  {comment.content}
              </Comment>
          );
      })
      return (
          <ul className="commentList">
              {commentNodes}
          </ul>
      )
  }
});

var CommentForm = React.createClass({
    getInitialState: function() {
        return {text: ''};
    },
    handleTextChange: function(e) {
        this.setState({text: e.target.value});
    },
    handleSubmit: function(e) {
        e.preventDefault();
        var text = this.state.text.trim();
        if (!text) {
            return;
        }
        this.props.onCommentSubmit({text: text});
        this.setState({text: ''});
    },
    render: function() {
        if (this.props.loggedIn) {
            return (
                <form id="commentForm" className="form-inline" role="form" onSubmit={this.handleSubmit}>
                    <div className="form-group">
                        <textarea form="commentForm" className="form-control" placeholder="Add comment!"
                                  value={this.state.text} onChange={this.handleTextChange}></textarea>
                    </div>
                    <div className="form-group">
                        <button type="submit" className="btn btn-default">Add</button>
                    </div>
                </form>
            );
        } else {
            return (
                <p>You have to login or register to comment</p>
            )
        }
    }
});

var CommentBox = React.createClass({
    loadCommentsFromServer: function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    handleCommentSubmit: function(comment) {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            type: 'POST',
            data: comment,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function() {
        return {data: []};
    },
    componentDidMount: function() {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer, this.props.pollInterval);
    },
    render: function() {
        return (
            <div className="commentBox">
                <h3>Comments</h3>
                <CommentForm onCommentSubmit={this.handleCommentSubmit} loggedIn={this.props.loggedIn} />
                <CommentList data={this.state.data} />
            </div>
        );
    }
});

// This should always be last
ReactDOM.render(
    <CommentBox url={window.location.pathname + '/comment'} pollInterval={2000} loggedIn={$("meta[name=login-status]").attr('content')} />,
    document.getElementById('comment-area')
);