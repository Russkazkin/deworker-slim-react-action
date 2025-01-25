import React from 'react';

type Props = {
  error: string | null;
};

const InputError: React.FC<Props> = ({ error }) => {
  return error ? (
    <div className="input-error" data-testid="violation">
      {error}
    </div>
  ) : null;
};

export default InputError;
