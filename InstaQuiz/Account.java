package InstaQuiz;

public abstract class Account {
	String email, password;
	boolean loggedIn;
    
	public abstract void login();

	public abstract void logout();

	public abstract boolean getLoggedIn();
}
