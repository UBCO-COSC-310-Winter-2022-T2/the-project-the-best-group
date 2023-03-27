package InstaQuiz;

public class Student extends Account
{
    Student(String email, String password)
    {
        this.email = email;
        this.password = password;
    }

    @Override
    public void login() {
        // yet to implement
    }

    @Override
    public void logout() {
        // yet to implement
    }

    @Override
    public boolean getLoggedIn()
    {
        return loggedIn;
    }
}
