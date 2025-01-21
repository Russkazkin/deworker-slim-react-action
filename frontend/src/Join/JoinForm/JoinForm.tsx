import React, { ChangeEvent, useState } from 'react';
import styles from './JoinForm.module.sass';

const JoinForm: React.FC = () => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    agree: false,
  });
  console.log('formData', formData);
  const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
    const input = event.target;
    setFormData(
      prevState => ({
        ...prevState,
        [input.name]: input.type === 'checkbox' ? input.checked : input.value,
      })
    );
  };

  return (
    <div data-testid="join-form" className={styles.joinForm}>
      <form className="form" method="post">
        <div className="input-row">
          <label htmlFor="email" className="input-label">
            Email
          </label>
          <input id="email" name="email" type="email" value={formData.email} onChange={handleChange} required />
        </div>
        <div className="input-row">
          <label htmlFor="password" className="input-label">
            Password
          </label>
          <input id="password" name="password" type="password" value={formData.password} onChange={handleChange} required />
        </div>
        <div className="input-row">
          <label>
            <input name="agree" type="checkbox" required checked={formData.agree} onChange={handleChange} />
            <small>I agree with privacy policy</small>
          </label>
        </div>
        <div className="button-row">
          <button type="submit">Join to Us</button>
        </div>
      </form>
    </div>
  );
};

export default JoinForm;
